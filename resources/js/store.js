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
        },
        loadStoredState(context) {
            const lastSearch = localStorage.getItem('lastSearch');

            if (lastSearch) {
                context.commit('setLastSearch', JSON.parse(lastSearch));
            }
        }
    }
};
