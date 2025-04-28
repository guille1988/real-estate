import { queryParams, type QueryParams } from './../../../../wayfinder'

/**
 * @see \App\Http\Controllers\AboutController::AboutController
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
const AboutController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: AboutController.url(options),
    method: 'get',
})

AboutController.definition = {
    methods: ['get','head'],
    url: '\/about',
}

/**
 * @see \App\Http\Controllers\AboutController::AboutController
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
AboutController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return AboutController.definition.url + queryParams(options)
}

/**
 * @see \App\Http\Controllers\AboutController::AboutController
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
AboutController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: AboutController.url(options),
    method: 'get',
})

/**
 * @see \App\Http\Controllers\AboutController::AboutController
 * @see app/Http/Controllers/AboutController.php:12
 * @route /about
 */
AboutController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: AboutController.url(options),
    method: 'head',
})

export default AboutController