import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\SubscriberController::__invoke
* @see app/Http/Controllers/SubscriberController.php:13
* @route '/subscribers'
*/
const SubscriberController = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: SubscriberController.url(options),
    method: 'post',
})

SubscriberController.definition = {
    methods: ["post"],
    url: '/subscribers',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\SubscriberController::__invoke
* @see app/Http/Controllers/SubscriberController.php:13
* @route '/subscribers'
*/
SubscriberController.url = (options?: RouteQueryOptions) => {
    return SubscriberController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SubscriberController::__invoke
* @see app/Http/Controllers/SubscriberController.php:13
* @route '/subscribers'
*/
SubscriberController.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: SubscriberController.url(options),
    method: 'post',
})

export default SubscriberController