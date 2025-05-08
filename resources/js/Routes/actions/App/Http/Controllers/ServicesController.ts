import { queryParams, type QueryParams } from './../../../../wayfinder'

/**
* @see \App\Http\Controllers\ServicesController::__invoke
* @see app/Http/Controllers/ServicesController.php:12
* @route '/services'
*/
const ServicesController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ServicesController.url(options),
    method: 'get',
})

ServicesController.definition = {
    methods: ['get','head'],
    url: '/services',
}

/**
* @see \App\Http\Controllers\ServicesController::__invoke
* @see app/Http/Controllers/ServicesController.php:12
* @route '/services'
*/
ServicesController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return ServicesController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ServicesController::__invoke
* @see app/Http/Controllers/ServicesController.php:12
* @route '/services'
*/
ServicesController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ServicesController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ServicesController::__invoke
* @see app/Http/Controllers/ServicesController.php:12
* @route '/services'
*/
ServicesController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: ServicesController.url(options),
    method: 'head',
})

export default ServicesController