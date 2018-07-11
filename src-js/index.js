import App from './App.vue'
import Toolbar from './mixins/ToolbarMixin'
import Language from './mixins/LanguageMixin'
import ListView from './mixins/ListViewMixin'
import DetailView from './mixins/DetailViewMixin'
import RedirectTo from './mixins/RedirectToMixin'
import FlashMessage from './components/FlashMessage.vue'
import CanCurrentUser from './mixins/CanCurrentUserMixin'
import FlashMessageMixin from './mixins/FlashMessageMixin'
import FilterItemProperties from './mixins/FilterItemPropertiesMixin'

export default {
    App,
    Toolbar,
    Language,
    ListView,
    DetailView,
    RedirectTo,
    FlashMessage,
    CanCurrentUser,
    FlashMessageMixin,
    FilterItemProperties,
}
