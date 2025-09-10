import LoginController from './LoginController'
import DashboardController from './DashboardController'

const Admin = {
    LoginController: Object.assign(LoginController, LoginController),
    DashboardController: Object.assign(DashboardController, DashboardController),
}

export default Admin