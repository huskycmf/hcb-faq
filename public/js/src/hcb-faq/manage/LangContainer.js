define([
    "dojo/_base/declare",
    "hc-backend/widget/ContentLocalization/LangContainer",
    "hc-backend/widget/ContentLocalization/service/Saver",
    "./widget/Form",
    "hcb-faq/store/FaqStore"
], function(declare, LangContainer, Saver, Form, FaqStore) {
    return declare([LangContainer], {
        formWidget: Form,
        store: FaqStore,

        _createSaverService: function (store) {
            try {
                return new Saver({polyglotCollectionStore: store,
                                  polyglotCollectionPath: '/localized'});
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
