<?php
function lang($phrase){
  static $lang = array(
    // Navbar Links
  "INDEX"      => "الرئيسية",
  "USERS" => "اعضاء الموقع",
  "ADMIN_USERS" => "المسجلين",
  "MEMBERS" => "الاعضاء",
  "CATEGORIES" => "فروع الديوانية ",
  "ITEMS" => "الفعاليات ",
  "COMMENTS" => "التعليقات ",
  "ABOUT" => "من نحن",
  "ITHRAA" => "لائحة إثراء",
  "LOGO" => "شعار الموقع",
  "CONTACT" => "اتصل بنا",
  "CLIENTS" => "العملاء",
  "SLIDESHOW" => "سلايد شو",
  "SOCIALMEDIA" => "التواصل الاجتماعى",
  "ACCORDION" => "اكورديون",
  "TABS" => "اقسام البوم الصور",
  "COUNTER" => "عداد الارقام",
  "TABSITEMS" => "البوم الصور ",
  "VIDEO" => " الفيديوهات",
  "REQUEST" => "Prices Requests",
  "MESSAGE" => "ارسل رسالة",
  "VISIT_SHOP" => "زيارة الموقع",
  "LOGOUT" => "تسجيل الخروج "
  );
  return $lang[$phrase];
};
?>
