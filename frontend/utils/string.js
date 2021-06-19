/**
 * Convert camel to kebab
 * @param string
 * @returns {string}
 */
export const camelToKebab = (string) => {
    return string
        .replace(/([a-z0-9]|(?=[A-Z]))([A-Z])/g, "$1-$2")
        .toLowerCase();
};

/**
 * Convert object to URL query string (get parameters)
 * @param obj
 * @returns {string}
 */
export const objectToQueryString = (obj) => {
    return Object.keys(obj)
        .filter((key) => {
            return !!obj[key];
        })
        .map((key) => {
            return `${camelToKebab(key)}=${encodeURIComponent(obj[key])}`;
        })
        .join("&");
};
