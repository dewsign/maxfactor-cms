import { AjaxStore } from 'ajax-store'

class RoleStore extends AjaxStore {
    constructor() {
        super({
            action: window.route('admin.role.index', '__locale__').toString(),
        })
    }
}

export default RoleStore
