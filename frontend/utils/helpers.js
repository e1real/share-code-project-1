import { objectToQueryString } from "@/utils/string";

/**
 * Query builder by filter
 * @param filterQuery
 * @return string
 */
export const queryBuildByFilterObject = (filterQuery) => {
    let filterIsEmpty = true;
    const filterKeys = Object.keys(filterQuery);
    for (let i = 0; i < filterKeys.length; i += 1) {
        if (filterQuery[filterKeys[i]]) {
            filterIsEmpty = false;
            break;
        }
    }
    let queryString = "";
    if (!filterIsEmpty) {
        queryString = objectToQueryString(filterQuery);
    }
    return queryString;
};
