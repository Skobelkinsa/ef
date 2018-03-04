<? //require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main;
use Bitrix\Sale\Internals;

AddEventHandler('sale', 'OnOrderNewSendEmail', array('CSendOrderPass', 'OnOrderNewSendEmailHandler'));
AddEventHandler('main', 'OnBeforeUserAdd', array('CSendOrderPass', 'OnBeforeUserAddHandler'));
AddEventHandler('sale', 'OnSaleComponentOrderOneStepComplete', array('CSendPaymentInfo', 'OnSaleComponentOrderOneStepCompleteHandler'));
AddEventHandler('subscribe', 'OnStartSubscriptionAdd', array('CSendSubscriptionInfo', 'OnStartSubscriptionAddHandler'));
AddEventHandler('sale', 'OnSaleStatusOrder', 'OnStatusUpdateEventHandler');
AddEventHandler("main", "OnAfterUserRegister", Array("DS_Register", "OnBeforeUserRegisterHandler"));

// Клас регистрации Дропшипера
class DS_Register
{
    function OnBeforeUserRegisterHandler(&$arFields)
    {
        if($arFields["USER_ID"]>0)
        {
            if(SITE_ID=="ds"){
                // Добовляем зарегистрированного пользователя в группу дропшиперов
                CUser::SetUserGroup($arFields["USER_ID"], array_merge(CUser::GetUserGroup($arFields["USER_ID"]), array(14)));
            }
        }
    }
}

class CSendOrderPass {

   private static $newUserLogin = false;
   private static $newUserPass = false;

   public static function OnBeforeUserAddHandler($arFields) {
      self::$newUserLogin = $arFields['LOGIN'];
      self::$newUserPass = $arFields['PASSWORD'];
   }

   public static function OnOrderNewSendEmailHandler($ID, $eventName, $arFields) {
      if (self::$newUserPass === false) {
         $arFields['PASSWORD'] = '';
      } else {
         $arFields['PASSWORD'] = "\n".'Ваш логин: '.self::$newUserLogin;
         $arFields['PASSWORD'] .= "\n".'Ваш пароль: '.self::$newUserPass;
      }
   }
}

class CSendPaymentInfo {
   public static function OnSaleComponentOrderOneStepCompleteHandler($id, $arOrder, $arParams) {
      if($arOrder['PAY_SYSTEM_ID'] == 10) {
         $arMailFields['EMAIL'] = $arOrder['USER_EMAIL'];
         $arMailFields['ORDER_ID'] = $arOrder['ACCOUNT_NUMBER'];

         CEvent::Send('SALE_PAYMENT_INFO', 's1', $arMailFields, "N", 37);
         //AddMessage2Log($id, "sale");
      }
   }
}

/**
 * Class CSendSubscriptionInfo
 */

class CSendSubscriptionInfo {
   /**
    * @param $arFields
    */
   function OnStartSubscriptionAddHandler(&$arFields) {
      $rs = CSubscription::GetByEmail($arFields["EMAIL"]);
      if(!$ar = $rs->Fetch()) {

         if($arFields["RUB_ID"][0] == "1") {
            // Создаем купок для скидки #2
            if (CModule::IncludeModule("catalog") && CModule::IncludeModule('sale'))
            {
               //$coupon = CatalogGenerateCoupon();

               // SL-**** ****
               $coupon = Internals\DiscountCouponTable::generateCoupon(true);

               $arCouponFields = array(
                   "DISCOUNT_ID" => (int) "2",
                   "COUPON" => (string) $coupon,
                   "TYPE" => (int) 2,
                   'USE_COUNT' => (int) 0,
                   'MAX_USE' => (int) 1,
                   'USER_ID' => (int) 0,
                   'MODIFIED_BY' => (int) 105,
                   'CREATED_BY' => (int) 105,
                   'DESCRIPTION' =>  $arFields["EMAIL"]
               );

               $result = Internals\DiscountCouponTable::add($arCouponFields);
               if (!$result->isSuccess()) {
                  $errors = $result->getErrorMessages();
                  AddMessage2Log($errors, "subscribe");
               } else {
                  // Отправляем письмо с промокодом
                  $arMailFields['EMAIL'] = $arFields['EMAIL'];
                  $arMailFields['PROMOCODE'] = $coupon;
                  CEvent::Send('SUBSCRIBE_PROMOCODE', 's1', $arMailFields, "N", 38);
               }

               /* Работа с скидками на товар ()
               ******************************
               $arCouponFields = array(
                   "DISCOUNT_ID" => "3",
                   "ACTIVE" => "Y",
                   "ONE_TIME" => "Y", //  Может принимать одно из трёх значений: Y - на одну позицию заказа, O - на весь заказ, N - многоразовый, по умолчанию - Y.
                   "COUPON" => $coupon,
                   "DATE_APPLY" => false,
                   "DESCRIPTION" => $arFields["EMAIL"]
               );

               CModule::IncludeModule("sale");


               $CID = CCatalogDiscountCoupon::Add($arCouponFields);
               $CID = IntVal($CID);
               if ($CID <= 0)
               {
                  global $APPLICATION;
                  $ex = $APPLICATION->GetException();
                  $errorMessage = $ex->GetString();
               } else {
                  // Отправляем письмо с промокодом
                  $arMailFields['EMAIL'] = $arFields['EMAIL'];
                  $arMailFields['PROMOCODE'] = $coupon;
                  CEvent::Send('SUBSCRIBE_PROMOCODE', 's1', $arMailFields, "N", 38);
               }
               */
            }
            //AddMessage2Log($arFields, "subscribe");
         }

      }

   }
}

/**
 * Функция обработчик события 'OnStatusUpdate'.
 *
 * @param $arFields\
 */
function addGroup ($id_user, $id_group, $del) {
    $arUserGroups = CUser::GetUserGroup($id_user);
    if($del==true){
        $key = array_search(9, $arUserGroups);
        if ($key !== false)
        {
            unset($arUserGroups[$key]);
        }
        $key = array_search(10, $arUserGroups);
        if ($key !== false)
        {
            unset($arUserGroups[$key]);
        }
        $key = array_search(11, $arUserGroups);
        if ($key !== false)
        {
            unset($arUserGroups[$key]);
        }
        $key = array_search(12, $arUserGroups);
        if ($key !== false)
        {
            unset($arUserGroups[$key]);
        }
    }
    $arUserGroup = array($id_group);
    $arUserGroupResult = array_merge($arUserGroups, $arUserGroup);
    CUser::SetUserGroup($id_user, $arUserGroupResult);
}
function OnStatusUpdateEventHandler ($id, $arFields) {
   if(CModule::IncludeModule("sale")) {
      // Статус заказа 'F' - выполнен:
      if ($arFields == 'F') {

         // Получаем id пользовтеля по id заказа
         if ($arOrder = CSaleOrder::GetByID($id)) {
            /**
             * Получаем массив значнией индентификаторов групп,
             * к которым пренадлежит пользователь, добавляем индентификатор группы
             * по которой действует ограничение примениения купона корзины.

             * */
            $arUserGroups = CUser::GetUserGroup($arOrder["USER_ID"]);
            $arUserGroup = array(7);
            //AddMessage2Log($arUserGroup, 'main');
            /**
             * Программа лояльности
             * 5% - 20 000
             * 10% - 50 000
             * 15% - 100 000
             * 20% - 150 000
             */
                 $SUMM = 0;
                 $arFilter = Array("USER_ID" => $arOrder["USER_ID"], "STATUS_ID" => "F");
                 $db_sales = CSaleOrder::GetList(array("ID" => "ASC"), $arFilter);
                 while ($ar_sales = $db_sales->Fetch())
                 {
                     $SUMM += $ar_sales["PRICE"];
                 }
                 if($SUMM >= 20000 && $SUMM < 50000){
                     // 5% discont
                     array_push($arUserGroup, 9);
                 }elseif ($SUMM >= 50000 && $SUMM < 100000) {
                     // 10% discont
                     array_push($arUserGroup, 10);
                 }elseif ($SUMM >= 100000 && $UMM < 150000) {
                     // 15% discont
                     array_push($arUserGroup, 11);
                 }elseif ($SUMM >= 150000) {
                     // 20% discont
                     array_push($arUserGroup, 12);
                 }
             AddMessage2Log($arUserGroup, "order_bay");
             $arUserGroupResult = array_merge($arUserGroups, $arUserGroup);
             CUser::SetUserGroup($arOrder["USER_ID"], $arUserGroupResult);
         } else {
            // Пишем ошибку в .log
            $error = "Заказ с кодом " . $id . " не найден";
            AddMessage2Log($error, "sale");
         }
      }
   }
}
function printr ($arr) {
    global $USER;
    if ($USER->IsAdmin())
    echo "<pre style='font-size:10px'>".print_r($arr, true)."</pre>";
}
