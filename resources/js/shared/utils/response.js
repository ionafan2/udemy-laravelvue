const isError = function (err) {
    return err.response && err.response.status;
}

export const is404 = function(err) {
    return isError(err) && 404 === err.response.status;
};

export const is422 = function(err) {
    return isError(err) && 422 === err.response.status;
};
