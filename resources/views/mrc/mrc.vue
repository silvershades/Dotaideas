<template>

</template>

<script>
export default {
    name: "mrc",
    data: function () {
        return {
            loading: false,
            publishing: false,
            selected_option: null,
            spell_mod_name: '',
            spell_mod_value: '',
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
            mrc: {
                id: 0,
                name: '',
                end_date: null,
                spell: {
                    name: '',
                    img_path: '',
                },
                img_path: '',
            },

        }
    },
    mounted() {
        this.loadMrc();
    },
    methods: {
        loadMrc() {
            var obj = this;
            this.loading = true;
            axios.post('/api/load-mrc')
                .then((response) => {
                    this.mrc = response.data.data[0];
                    // this.current_spell = this.mrc.spell[0];
                    this.loading = false;
                })
                .catch(function (error) {
                    obj.loading = false;
                    // console.log(error)
                });
        },
        addSpellModifier: function (value) {
            if (this.spell_mod_name != '' && this.spell_mod_value != '') {

                let new_modifier = {
                    name: this.spell_mod_name,
                    value: this.spell_mod_value
                }

                this.current_spell.spell_attributes.unshift(new_modifier);

                this.spell_mod_name = '';
                this.spell_mod_value = '';
            }
        },
        deleteSpellModifier: function (that) {
            Vue.delete(this.current_spell.spell_attributes, that);
        },
        submitRework: function () {
            if (this.current_spell.name == '' || this.current_spell.description == '') {
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Ability is incomplete' , {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
            } else {

                this.publishing = true;
                let obj = this;
                const formData = new FormData();
                formData.append('mrc', this.mrc.id);
                formData.append('spell', JSON.stringify(this.current_spell));

                axios.post('/api/mrc-entry', formData, {'content-type': 'multipart/form-data'})
                    .then((response) => {
                        this.publishing = false;
                        if (response.data.status === 'success') {
                            Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Post completed' , {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
                            window.location.replace("/mrcs-entries");
                        } else if (response.data.status === 'error') {
                            Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> An error ocurred' , {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
                        }
                    })
                    .catch(function (error) {
                        obj.publishing = false;

                    });


            }
        },
    }
}
</script>

<style scoped>

</style>
