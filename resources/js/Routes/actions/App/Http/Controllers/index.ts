import HomeController from './HomeController'
import AboutController from './AboutController'
import ServiceController from './ServiceController'
import ContactController from './ContactController'
import ContactMessageController from './ContactMessageController'
import PropertyController from './PropertyController'
import PropertyMessageController from './PropertyMessageController'
import SubscriberController from './SubscriberController'

const Controllers = {
    HomeController: Object.assign(HomeController, HomeController),
    AboutController: Object.assign(AboutController, AboutController),
    ServiceController: Object.assign(ServiceController, ServiceController),
    ContactController: Object.assign(ContactController, ContactController),
    ContactMessageController: Object.assign(ContactMessageController, ContactMessageController),
    PropertyController: Object.assign(PropertyController, PropertyController),
    PropertyMessageController: Object.assign(PropertyMessageController, PropertyMessageController),
    SubscriberController: Object.assign(SubscriberController, SubscriberController),
}

export default Controllers