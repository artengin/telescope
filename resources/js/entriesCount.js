import axios from 'axios';

export default {
    methods: {
        loadEntriesCount() {
            return axios.get(Telescope.basePath + '/telescope-api/entries/count')
                .then(response => {

                    this.requestsCount = response.data.requests;
                    this.commandsCount = response.data.commands;

                    if (this.$root) {
                        this.$root.requestsCount = this.requestsCount;
                        this.$root.commandsCount = this.commandsCount;
                    }

                    return response.data;
                });
        },

        scheduleEntriesCount() {
            if (this.entriesCountTimeout) clearTimeout(this.entriesCountTimeout);

            this.entriesCountTimeout = setTimeout(() => {
                this.loadEntriesCount();
                this.scheduleEntriesCount();
            }, this.entriesCountTimer);
        },

        clearEntriesCountTimeout() {
            if (this.entriesCountTimeout) {
                clearTimeout(this.entriesCountTimeout);
                this.entriesCountTimeout = null;
            }
        },
    }
};
