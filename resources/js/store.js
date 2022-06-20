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
    },
    actions: {
        setLastSearch(context, payload) {
            context.commit('setLastSearch', payload);
            localStorage.setItem('lastSearch', JSON.stringify(payload));
        }
    }
};
