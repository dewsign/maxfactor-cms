import { AjaxStore } from 'ajax-store'

class PermissionStore extends AjaxStore {
    constructor() {
        super({
            action: window.route('admin.role.permissions', '__locale__').toString(),
        })
    }
}

export default PermissionStore
