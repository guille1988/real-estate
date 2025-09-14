import AdminController from './AdminController'
import LoginController from './LoginController'
import DashboardController from './DashboardController'

const Admin = {
    AdminController: Object.assign(AdminController, AdminController),
    LoginController: Object.assign(LoginController, LoginController),
    DashboardController: Object.assign(DashboardController, DashboardController),
}

export default Admin