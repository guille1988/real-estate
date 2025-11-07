import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:19
* @route '/admin/pricing-details'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/pricing-details',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:19
* @route '/admin/pricing-details'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:19
* @route '/admin/pricing-details'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:19
* @route '/admin/pricing-details'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const pricingDetails = {
    index: Object.assign(index, index),
}

export default pricingDetails