import { AjaxStore } from 'ajax-store'

class UserStore extends AjaxStore {
    constructor() {
        super({
            action: window.route('admin.user.index', '__locale__').toString(),
        })
    }
}

export default UserStore
