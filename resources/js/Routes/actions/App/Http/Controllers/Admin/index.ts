import AdminController from './AdminController'
import LoginController from './LoginController'
import ProfileController from './ProfileController'
import DashboardController from './DashboardController'
import PropertyController from './PropertyController'

const Admin = {
    AdminController: Object.assign(AdminController, AdminController),
    LoginController: Object.assign(LoginController, LoginController),
    ProfileController: Object.assign(ProfileController, ProfileController),
    DashboardController: Object.assign(DashboardController, DashboardController),
    PropertyController: Object.assign(PropertyController, PropertyController),
}

export default Admin