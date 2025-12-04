import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
import login from './login'
import profile from './profile'
import properties from './properties'
import images from './images'
import pricingDetails from './pricing-details'
import amenities from './amenities'
import propertyMessages from './property-messages'
import inquiries from './inquiries'
/**
* @see \App\Http\Controllers\Admin\DashboardController::__invoke
* @see app/Http/Controllers/Admin/DashboardController.php:13
* @route '/admin/dashboard'
*/
export const dashboard = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

dashboard.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\DashboardController::__invoke
* @see app/Http/Controllers/Admin/DashboardController.php:13
* @route '/admin/dashboard'
*/
dashboard.url = (options?: RouteQueryOptions) => {
    return dashboard.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardController::__invoke
* @see app/Http/Controllers/Admin/DashboardController.php:13
* @route '/admin/dashboard'
*/
dashboard.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\DashboardController::__invoke
* @see app/Http/Controllers/Admin/DashboardController.php:13
* @route '/admin/dashboard'
*/
dashboard.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: dashboard.url(options),
    method: 'head',
})

const admin = {
    login: Object.assign(login, login),
    profile: Object.assign(profile, profile),
    dashboard: Object.assign(dashboard, dashboard),
    properties: Object.assign(properties, properties),
    images: Object.assign(images, images),
    pricingDetails: Object.assign(pricingDetails, pricingDetails),
    amenities: Object.assign(amenities, amenities),
    propertyMessages: Object.assign(propertyMessages, propertyMessages),
    inquiries: Object.assign(inquiries, inquiries),
}

export default admin