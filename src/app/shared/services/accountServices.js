import { getPayloadToken, getToken } from './tokenServices';

/**
 * To get all the roles of the current user
 *
 * @return {Array} roles of the current user
 * @author Peter Mollet
 */
export function accountRoles() {
    const payload = getPayloadToken();
    return payload.roles.split(',');
}

/**
 * To get the login of the current user
 *
 * @return {string} login of the current user
 * @author Peter Mollet
 */
export function accountLogin() {
    const payload = getPayloadToken();
    return payload.sub;
}

export function hasRole(role) {
    return accountRoles().includes(role);
}

/**
 * To check if the current user is authenticated
 * Check the token, and it's validity
 *
 * @return {boolean} true if user is authenticated
 * @author Peter Mollet
 */
export function isAuthenticated() {
    try {
        const token = getToken();
        const payload = getPayloadToken();
        const expirationDate = payload.exp;
        const roles = payload.roles;
        const login = payload.user;
        const is_active = payload.is_active;
        const dateNow = new Date();
        return token && roles.length > 0 && login && expirationDate < dateNow.getTime() && is_active == true;
    } catch {
        return false;
    }
}
