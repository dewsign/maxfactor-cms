import { AjaxStore } from 'ajax-store'

class CurrentUserStore extends AjaxStore {
    constructor() {
        super({
            action: window.route('admin.user.current', '__locale__').toString(),
        })
    }
}

export default CurrentUserStore
