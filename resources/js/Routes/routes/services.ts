import { queryParams, type QueryParams } from './../wayfinder'

/**
 * @see \App\Http\Controllers\ServicesController::services
 * @see app/Http/Controllers/ServicesController.php:12
 * @route /services
 */
export const services = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: services.url(options),
    method: 'get',
})

services.definition = {
    methods: ['get','head'],
    url: '\/services',
}

/**
 * @see \App\Http\Controllers\ServicesController::services
 * @see app/Http/Controllers/ServicesController.php:12
 * @route /services
 */
services.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return services.definition.url + queryParams(options)
}

/**
 * @see \App\Http\Controllers\ServicesController::services
 * @see app/Http/Controllers/ServicesController.php:12
 * @route /services
 */
services.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: services.url(options),
    method: 'get',
})

/**
 * @see \App\Http\Controllers\ServicesController::services
 * @see app/Http/Controllers/ServicesController.php:12
 * @route /services
 */
services.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: services.url(options),
    method: 'head',
})

export default services