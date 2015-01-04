define([
    "dojo/_base/declare",
    "hc-backend/widget/ContentLocalization/widget/Form",
    "hc-backend/form/_HasPageFieldsMixin",
    "dijit/_WidgetsInTemplateMixin",
    "dojo/text!./templates/Form.html",
    "dojo/i18n!../../nls/Manage",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox"
], function(declare, Form, _HasPageFieldsMixin,
            _WidgetsInTemplateMixin, template, translate) {
    return declare([ Form, _HasPageFieldsMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding faqs to the CMS database

        templateString: template,

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: translate
    });
});
