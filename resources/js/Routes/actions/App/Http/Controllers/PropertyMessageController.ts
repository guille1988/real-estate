import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PropertyMessageController::__invoke
* @see app/Http/Controllers/PropertyMessageController.php:13
* @route '/properties/messages'
*/
const PropertyMessageController = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: PropertyMessageController.url(options),
    method: 'post',
})

PropertyMessageController.definition = {
    methods: ["post"],
    url: '/properties/messages',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PropertyMessageController::__invoke
* @see app/Http/Controllers/PropertyMessageController.php:13
* @route '/properties/messages'
*/
PropertyMessageController.url = (options?: RouteQueryOptions) => {
    return PropertyMessageController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyMessageController::__invoke
* @see app/Http/Controllers/PropertyMessageController.php:13
* @route '/properties/messages'
*/
PropertyMessageController.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: PropertyMessageController.url(options),
    method: 'post',
})

export default PropertyMessageController