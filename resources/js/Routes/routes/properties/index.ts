import show from './show'
import { queryParams, type QueryParams } from './../../wayfinder'

/**
 * @see \App\Http\Controllers\PropertiesController::index
 * @see app/Http/Controllers/PropertiesController.php:12
 * @route /properties
 */
export const index = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ['get','head'],
    url: '\/properties',
}

/**
 * @see \App\Http\Controllers\PropertiesController::index
 * @see app/Http/Controllers/PropertiesController.php:12
 * @route /properties
 */
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
 * @see \App\Http\Controllers\PropertiesController::index
 * @see app/Http/Controllers/PropertiesController.php:12
 * @route /properties
 */
index.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

/**
 * @see \App\Http\Controllers\PropertiesController::index
 * @see app/Http/Controllers/PropertiesController.php:12
 * @route /properties
 */
index.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: index.url(options),
    method: 'head',
})

const properties = {
    index, 
    show,
}

export default properties