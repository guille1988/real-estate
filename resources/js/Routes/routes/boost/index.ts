import { queryParams, type QueryParams } from './../../wayfinder'
/**
* @see vendor/laravel/boost/src/BoostServiceProvider.php:100
* @route '/_boost/browser-logs'
*/
export const browserLogs = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: browserLogs.url(options),
    method: 'post',
})

browserLogs.definition = {
    methods: ['post'],
    url: '/_boost/browser-logs',
}

/**
* @see vendor/laravel/boost/src/BoostServiceProvider.php:100
* @route '/_boost/browser-logs'
*/
browserLogs.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return browserLogs.definition.url + queryParams(options)
}

/**
* @see vendor/laravel/boost/src/BoostServiceProvider.php:100
* @route '/_boost/browser-logs'
*/
browserLogs.post = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'post',
} => ({
    url: browserLogs.url(options),
    method: 'post',
})

const boost = {
    browserLogs,
}

export default boost