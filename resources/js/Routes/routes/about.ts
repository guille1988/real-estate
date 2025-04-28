import { queryParams, type QueryParams } from './../wayfinder'

/**
 * @see \App\Http\Controllers\AboutController::about
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
export const about = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: about.url(options),
    method: 'get',
})

about.definition = {
    methods: ['get','head'],
    url: '\/about',
}

/**
 * @see \App\Http\Controllers\AboutController::about
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
about.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return about.definition.url + queryParams(options)
}

/**
 * @see \App\Http\Controllers\AboutController::about
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
about.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: about.url(options),
    method: 'get',
})

/**
 * @see \App\Http\Controllers\AboutController::about
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
about.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: about.url(options),
    method: 'head',
})

export default about