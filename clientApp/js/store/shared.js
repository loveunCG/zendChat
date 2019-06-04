export default {
  state: {
    selectData: false,
    submitData: null,
    error: null
  },
  mutations: {
    setSelectedData(state, payload) {
      state.selectData = payload;
    },
    clearSelectedData(state) {
      state.selectData = false;
    },
    setSubmitData(state, payload) {
      state.submitData = payload;
    },
    clearSubmitData(state) {
      state.submitData = false;
    }
  },
  actions: {
    clearSelectedData({ commit }) {
      commit("clearSelectedData");
    },
    setSelectedData({ commit }, payload) {
      commit("setSelectedData", payload);
    },
    clearSubmitData({ commit }) {
      commit("clearSubmitData");
    },
    setSubmitData({ commit }, payload) {
      commit("setSubmitData", payload);
    }
  },
  getters: {
    selectedData(state) {
      return state.selectData;
    },
    submitData(state) {
      return state.submitData;
    },
    error(state) {
      return state.error;
    }
  }
};
