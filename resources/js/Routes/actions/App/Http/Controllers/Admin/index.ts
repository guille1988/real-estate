import AdminController from './AdminController'
import LoginController from './LoginController'
import ProfileController from './ProfileController'
import DashboardController from './DashboardController'
import PropertyController from './PropertyController'
import ImageController from './ImageController'
import PricingDetailController from './PricingDetailController'

const Admin = {
    AdminController: Object.assign(AdminController, AdminController),
    LoginController: Object.assign(LoginController, LoginController),
    ProfileController: Object.assign(ProfileController, ProfileController),
    DashboardController: Object.assign(DashboardController, DashboardController),
    PropertyController: Object.assign(PropertyController, PropertyController),
    ImageController: Object.assign(ImageController, ImageController),
    PricingDetailController: Object.assign(PricingDetailController, PricingDetailController),
}

export default Admin