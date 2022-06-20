export default {
    state: {
        lastSearch: {
            startDate:null,
            endDate:null,
        }
    },
    mutations: {
        setLastSearch (state, payload) {
            this.state.lastSearch = payload;
        }
    }
};
