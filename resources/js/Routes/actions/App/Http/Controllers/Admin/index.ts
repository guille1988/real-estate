import AdminController from './AdminController'
import LoginController from './LoginController'
import ProfileController from './ProfileController'
import DashboardController from './DashboardController'
import PropertyController from './PropertyController'
import ImageController from './ImageController'
import PricingDetailController from './PricingDetailController'
import AmenityController from './AmenityController'
import PropertyMessageController from './PropertyMessageController'
import InquiryController from './InquiryController'
import ContactMessageController from './ContactMessageController'

const Admin = {
    AdminController: Object.assign(AdminController, AdminController),
    LoginController: Object.assign(LoginController, LoginController),
    ProfileController: Object.assign(ProfileController, ProfileController),
    DashboardController: Object.assign(DashboardController, DashboardController),
    PropertyController: Object.assign(PropertyController, PropertyController),
    ImageController: Object.assign(ImageController, ImageController),
    PricingDetailController: Object.assign(PricingDetailController, PricingDetailController),
    AmenityController: Object.assign(AmenityController, AmenityController),
    PropertyMessageController: Object.assign(PropertyMessageController, PropertyMessageController),
    InquiryController: Object.assign(InquiryController, InquiryController),
    ContactMessageController: Object.assign(ContactMessageController, ContactMessageController),
}

export default Admin