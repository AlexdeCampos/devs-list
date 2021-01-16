import developerSevice from '../../services/developers'
const state = { developerList: [], returnMessage: "" }

const actions = {
    async listDevelopers({ commit }, { page, quantity }) {
        const { data } = await developerSevice.list(page, quantity)
        commit('setDevelopersList', data)
    },
    async getDeveloper({ commit }, id) {
        const { data } = await developerSevice.get(id)
        return { data: data.data }
    },
    async deleteDeveloper({ commit }, id) {
        try {
            const { data } = await developerSevice.del(id)
            commit('deleteDeveloperFromList', id)
            commit('setMessage', data.message)
        } catch (error) {
            throw commit('setMessage', error.response.data.message)
        }
    },
    async newDeveloper({ commit }, dev) {
        try {
            const { data } = await developerSevice.create(dev)
            commit('addDeveloperToList', data.data)
            commit('setMessage', data.message)
        } catch (error) {
            throw commit('setMessage', error.response.data.message)
        }
    },
    async editDeveloper({ commit }, dev) {
        try {
            const { data } = await developerSevice.edit(dev)
            commit('setMessage', data.message)
            commit('editDeveloperInList', data.data)
        } catch (error) {
            throw commit('setMessage', error.response.data.message)
        }
    }
}

const mutations = {
    setDevelopersList(state, payload) {
        state.developerList = payload
    },
    deleteDeveloperFromList(state, payload) {
        state.developerList.data = state.developerList.data.filter((developer) => developer.id !== payload)
        console.log(payload)
    },
    addDeveloperToList(state, payload) {
        state.developerList.data.push(payload)
    },
    editDeveloperInList(state, payload) {
        console.log("asdg")
        const index = state.developerList.data.findIndex((developer) => developer.id === payload.id)
        state.developerList.data[index] = payload
    },
    setMessage(state, payload) {
        console.log(payload)
        state.returnMessage = payload
    }
}

export default { namespaced: true, state, actions, mutations }