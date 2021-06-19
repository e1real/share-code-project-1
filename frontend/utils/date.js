const defaultLocales = "en";
const defaultOptions = {
    day: "numeric",
    month: "short",
    year: "numeric",
    literal: ".",
};

/**
 * Format date from string
 * @param {Date} date
 * @param {string} locales
 * @param {Object} options
 * @returns {string} format date
 */
export const dateFormatIntl = (
    date,
    locales = defaultLocales,
    options = defaultOptions
) => {
    if (date) return new Intl.DateTimeFormat(locales, options).format(date);
    return undefined;
};

/**
 * Format date to string
 * @param {Date} date
 * @returns {string} format date
 */
export const dateFormatToStringYmd = (date) => {
    let d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    return [year, month, day].join("-");
};
