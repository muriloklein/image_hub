import { defineStore } from "pinia";
import axiosClient from "../axios";

const useUserStore = defineStore('user', {
    state: () => ({
        user: null,
    }),
    actions: {
        async fetchUser() {
            return axiosClient.get('/api/user', {
                    Accept: 'application/json',
                }).then(response => {
                    console.log(response);
                    this.user = response.data;
                }
        )},
    },
});

export default useUserStore;