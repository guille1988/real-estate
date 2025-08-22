import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
const ServiceController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ServiceController.url(options),
    method: 'get',
})

ServiceController.definition = {
    methods: ["get","head"],
    url: '/services',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
ServiceController.url = (options?: RouteQueryOptions) => {
    return ServiceController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
ServiceController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ServiceController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
ServiceController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ServiceController.url(options),
    method: 'head',
})

export default ServiceController