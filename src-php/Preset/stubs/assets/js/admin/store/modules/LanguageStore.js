import { merge, map, concat } from 'lodash'
import { AjaxStore } from 'ajax-store'

class LanguageStore extends AjaxStore {
    constructor() {
        super({
            action: route('admin.language.index', '__locale__').toString(),
        })
    }

    getStore() {
        return merge(super.getStore(), {

            getters: {
                languageIdentifiers: (state, {items}) => {
                    return concat('en', map(items, 'locale'))
                }
            }
        })
    }
}

export default LanguageStore
