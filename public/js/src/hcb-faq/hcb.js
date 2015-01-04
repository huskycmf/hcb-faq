define([
    "dojo/_base/declare",
    "hc-backend/layout/main/content/package",
    "dojo/i18n!./nls/Package",
    "xstyle/css!./css/faq.css"
], function(declare, _Package, translation) {
    return declare("FaqPackage", [ _Package ], {
        title: translation['packageTitle']
    });
});
