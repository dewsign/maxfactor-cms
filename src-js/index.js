import App from './App.vue'
import Repeaters from './repeaters/index'
import Toolbar from './mixins/ToolbarMixin'
import Language from './mixins/LanguageMixin'
import ListView from './mixins/ListViewMixin'
import DetailView from './mixins/DetailViewMixin'
import RedirectTo from './mixins/RedirectToMixin'
import ContentCard from './components/ContentCard.vue'
import FlashMessage from './components/FlashMessage.vue'
import CanCurrentUser from './mixins/CanCurrentUserMixin'
import FlashMessageMixin from './mixins/FlashMessageMixin'
import MetaAttributes from './components/MetaAttributes.vue'
import FeaturedImageMixin from './mixins/FeaturedImageMixin'
import RepeaterBlocks from './components/RepeaterBlocks.vue'
import RepeaterChoices from './components/RepeaterChoices.vue'
import FilterItemProperties from './mixins/FilterItemPropertiesMixin'

export default {
    App,
    Toolbar,
    Language,
    ListView,
    Repeaters,
    DetailView,
    RedirectTo,
    ContentCard,
    FlashMessage,
    RepeaterBlocks,
    CanCurrentUser,
    MetaAttributes,
    RepeaterChoices,
    FlashMessageMixin,
    FeaturedImageMixin,
    FilterItemProperties,
}
