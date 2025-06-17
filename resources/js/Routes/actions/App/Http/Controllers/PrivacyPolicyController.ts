import { queryParams, type QueryParams } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PrivacyPolicyController::__invoke
* @see app/Http/Controllers/PrivacyPolicyController.php:12
* @route '/privacy-policy'
*/
const PrivacyPolicyController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PrivacyPolicyController.url(options),
    method: 'get',
})

PrivacyPolicyController.definition = {
    methods: ['get','head'],
    url: '/privacy-policy',
}

/**
* @see \App\Http\Controllers\PrivacyPolicyController::__invoke
* @see app/Http/Controllers/PrivacyPolicyController.php:12
* @route '/privacy-policy'
*/
PrivacyPolicyController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return PrivacyPolicyController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PrivacyPolicyController::__invoke
* @see app/Http/Controllers/PrivacyPolicyController.php:12
* @route '/privacy-policy'
*/
PrivacyPolicyController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: PrivacyPolicyController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PrivacyPolicyController::__invoke
* @see app/Http/Controllers/PrivacyPolicyController.php:12
* @route '/privacy-policy'
*/
PrivacyPolicyController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: PrivacyPolicyController.url(options),
    method: 'head',
})

export default PrivacyPolicyController