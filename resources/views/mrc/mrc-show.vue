<template>

</template>

<script>
export default {
    name: "mrc-show",
    data: function () {
        return {
            loading: false,
            loading_vote: false,
            no_entries: false,
            par: false,
            spells: [],
            current_spell: {
                name: '',
                placeholder: 'Enter Q ability name here...',
                hotkey: 'Q',

                image_show: '',
                description: '',
                spell_type: 1,
                spell_target: 1,
                spell_damage_type: 1,
                pierces_bkb: 1,
                dispellable: 1,
                breakable: 1,
                blocked_by_linkens: 1,
                cast_while_rooted: 1,
                mod_by_aghanims_scepter: 0,
                mod_by_aghanims_scepter_desc: '',
                mod_by_aghanims_shard: 0,
                mod_by_aghanims_shard_desc: '',
                created_by_aghanims_scepter: 0,
                created_by_aghanims_shard: 0,
                manacost: '',
                cooldown: '',
                spell_attributes: []
            },
            current_index: 0,
            max_index: 0,
        }
    },
    mounted() {
        this.loadMrc();
    },
    methods: {
        loadMrc() {
            var obj = this;
            this.loading = true;
            let id = window.location.href.split('/').pop();
            const formData = new FormData();
            formData.append('mrc', id);

            axios.post('/api/load-mrc-spells', formData)
                .then((response) => {
                    // this.spells = response.data.data;
                    this.spells = this.shuffle(response.data.data);
                    if (this.spells.length > 0) {
                        this.current_spell = this.spells[0];
                    }else{
                        this.no_entries = true;
                    }
                    this.loading = false;
                })
                .catch(function (error) {
                    obj.loading = false;
                });
        },
        Next() {
            if (this.current_index == this.spells.length - 1) {
                this.current_index = 0;
            } else {
                this.current_index++;
            }
            this.current_spell = this.spells[this.current_index];
            this.par = !this.par;
        },
        VoteNeg(spell) {
            var obj = this;
            this.loading_vote = true;
            let id = window.location.href.split('/').pop();
            const formData = new FormData();
            formData.append('mrc', id);
            formData.append('mrc_spell', spell);
            formData.append('vote', '-1');
            axios.post('/api/mrc-vote', formData)
                .then((response) => {
                    this.loading_vote = false;
                    if (this.current_spell.voted) {
                        this.current_spell.voted.vote = -1;
                    } else {
                        this.current_spell.voted = {vote: -1};
                    }
                    this.Next();
                })
                .catch(function (error) {
                    obj.loading_vote = false;
                });
        },
        VotePos(spell) {
            var obj = this;
            this.loading_vote = true;
            let id = window.location.href.split('/').pop();
            const formData = new FormData();
            formData.append('mrc', id);
            formData.append('mrc_spell', spell);
            formData.append('vote', '1');
            axios.post('/api/mrc-vote', formData)
                .then((response) => {
                    this.loading_vote = false;
                    if (this.current_spell.voted) {
                        this.current_spell.voted.vote = 1;
                    } else {
                        this.current_spell.voted = {vote: 1};
                    }
                    this.Next();
                })
                .catch(function (error) {
                    obj.loading_vote = false;
                });
        },
        shuffle(array) {
            let currentIndex = array.length, randomIndex;

            // While there remain elements to shuffle...
            while (currentIndex != 0) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;

                // And swap it with the current element.
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex], array[currentIndex]];
            }

            return array;
        },

    }
}
</script>

<style scoped>
.slide-fade-enter-active {
    transition: all .5s ease-in;
}

.slide-fade-leave-active {
    transition: none;
}

.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */
{
    transform: translateX(10px);
    opacity: 0;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 1s
}

.fade-leave-to {
    opacity: 0
}
</style>
