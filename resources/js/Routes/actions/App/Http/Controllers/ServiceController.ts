import { queryParams, type QueryParams } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
const ServiceController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ServiceController.url(options),
    method: 'get',
})

ServiceController.definition = {
    methods: ['get','head'],
    url: '/services',
}

/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
ServiceController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return ServiceController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
ServiceController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ServiceController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ServiceController::__invoke
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
ServiceController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: ServiceController.url(options),
    method: 'head',
})

export default ServiceController