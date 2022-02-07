<script>
export default {
    name: "hero-edit",

    data: function () {
        return {
            loading: false,
            loading_hero: false,
            publishing: false,
            publish_modal: false,
            ajax_errors: {},
            ajax_success: '',
            exception: false,
            post_created_id: '',

            current_level: 1,
            current_strength: 0,
            current_agility: 0,
            current_intelligence: 0,
            selectedHero: '',
            spell_mod_key: '',
            spell_mod_value: '',
            errors: {
                hero: [],
                spells: [],
                talents: [],
                description: [],
            },
            errors_debug: '',
            dhero: {
                name: '',
                is_active: 0,
                image_show: '',
                description: '',
                lore: '',
                primary_attribute: 1,
                attack_type: 1,
                complexity: 1,
                strength: 20,
                lvlup_strength: 2,
                agility: 20,
                lvlup_agility: 2,
                intelligence: 20,
                lvlup_intelligence: 2,
                attack_damage_min: 20,
                attack_damage_max: 30,
                attack_bat: 1.7,
                attack_ias: 100,
                attack_range: 500,
                defense_armor: 4,
                defense_magic_resistance: 25,
                mobility_speed: 390,
                mobility_turn_rate: 0.5,
                mobility_vision_day: 800,
                mobility_vision_night: 1800,
                basic_regen_hp: 0.25,
                basic_regen_mana: 0,
                roles_carry: 0,
                roles_support: 2,
                roles_nuker: 1,
                roles_disabler: 3,
                roles_jungler: 1,
                roles_durable: 3,
                roles_escape: 1,
                roles_pusher: 1,
                roles_initiator: 0,
                strengths_team_fight: 2,
                strengths_farm: 1,
                strengths_split_push: 1,
                strengths_siege: 1,
                strengths_base_defense: 1,
                strengths_roshan: 1,
                damage_pure: 0,
                damage_physical: 3,
                damage_magical: 1,
                talent_25_left: '',
                talent_25_right: '',
                talent_20_left: '',
                talent_20_right: '',
                talent_15_left: '',
                talent_15_right: '',
                talent_10_left: '',
                talent_10_right: '',
            },
            selected_spell: 'Q',
            current_spell: {},
            spell_Q: {
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
            spell_W: {
                name: '',
                placeholder: 'Enter W ability name here...',
                hotkey: 'W',

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
            spell_E: {
                name: '',
                placeholder: 'Enter E ability name here...',
                hotkey: 'E',

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
            spell_R: {
                name: '',
                placeholder: 'Enter R ability name here...',
                hotkey: 'R',

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
            spell_D: {
                name: '',
                placeholder: 'This D ability is OPTIONAL...',
                hotkey: 'D',

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
            spell_F: {
                name: '',
                placeholder: 'This F ability is OPTIONAL...',
                hotkey: 'F',

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
            images: {
                hero: '',
                Q: '',
                W: '',
                E: '',
                R: '',
                D: '',
                F: '',
            },
            spells:[]
        }
    },
    mounted() {
        this.getHero();
        this.calculateData();
        this.changeCurrentSpell('Q')

    },
    methods: {
        getHero() {
            var obj = this;
            let id = window.location.href.split('/').pop();
            this.loading = true;
            axios.get('/api/get-hero/' + id)
                .then((response) => {
                    this.dhero = response.data.data[0];
                    this.getSpells();
                    this.calculateData();
                    this.loading = false;
                })
                .catch(function (error) {
                    obj.loading = false;
                    console.log(error)
                });
        },
        getSpells() {
            var obj = this;
            this.loading = true;
            axios.get('/api/hero-spells/' + this.dhero.id)
                .then((response) => {
                    this.spells = response.data.data;
                    this.asingSpells();
                    this.loading = false;
                })
                .catch(function (error) {
                    obj.loading = false;
                });
        },
        asingSpells() {
            for (var i = 0; i < this.spells.length; i++) {
                let hotkey = this.spells[i].hotkey;
                switch (hotkey) {
                    case 'Q': {
                        this.spell_Q = this.spells[i];
                        break;
                    }
                    case 'W': {
                        this.spell_W = this.spells[i];
                        break;
                    }
                    case 'E': {
                        this.spell_E = this.spells[i];
                        break;
                    }
                    case 'R': {
                        this.spell_R = this.spells[i];
                        break;
                    }
                    case 'D': {
                        this.spell_D = this.spells[i];
                        break;
                    }
                    case 'F': {
                        this.spell_F = this.spells[i];
                        break;
                    }
                    default: {
                        // console.log(spell);
                    }

                }
                this.changeCurrentSpell('Q')
            }
        },
        async loadHero() {
            await this.fetchHero();
        },
        fetchHero() {
            if (this.selectedHero !== '') {
                this.loading_hero = true;
                axios.get('/api/dota-hero/?hero=' + this.selectedHero)
                    .then((response) => {
                        // console.log(new_hero);
                        this.dhero = response.data.data[0];
                        // console.log('loaded');
                        this.calculateData();
                        this.loading_hero = false;
                    })
                    .catch(function (error) {
                        this.loading_hero = false;
                        // console.log(error);
                    });
            }
        },
        changeCurrentSpell: function (value) {
            switch (value) {
                case 'Q': {
                    this.current_spell = this.spell_Q;
                    this.selected_spell = 'Q';
                    break;
                }
                case 'W': {
                    this.current_spell = this.spell_W;
                    this.selected_spell = 'W';
                    break;
                }
                case 'E': {
                    this.current_spell = this.spell_E;
                    this.selected_spell = 'E';
                    break;
                }
                case 'R': {
                    this.current_spell = this.spell_R;
                    this.selected_spell = 'R';
                    break;
                }
                case 'D': {
                    this.current_spell = this.spell_D;
                    this.selected_spell = 'D';
                    break;
                }
                case 'F': {
                    this.current_spell = this.spell_F;
                    this.selected_spell = 'F';
                    break;
                }
            }

        },
        addSpellModifier: function (value) {
            if (this.spell_mod_key != '' && this.spell_mod_value != '') {

                let new_modifier = {
                    key: this.spell_mod_key,
                    value: this.spell_mod_value
                }
                switch (this.selected_spell) {
                    case 'Q': {
                        this.spell_Q.spell_attributes.unshift(new_modifier);
                        break;
                    }
                    case 'W': {
                        this.spell_W.spell_attributes.unshift(new_modifier);
                        break;
                    }
                    case 'E': {
                        this.spell_E.spell_attributes.unshift(new_modifier);
                        break;
                    }
                    case 'R': {
                        this.spell_R.spell_attributes.unshift(new_modifier);
                        break;
                    }
                    case 'D': {
                        this.spell_D.spell_attributes.unshift(new_modifier);
                        break;
                    }
                    case 'F': {
                        this.spell_F.spell_attributes.unshift(new_modifier);
                        break;
                    }
                }
                this.spell_mod_key = '';
                this.spell_mod_value = '';
            }
            console.log(this.current_spell)
        },
        deleteSpellModifier: function (that) {
            Vue.delete(this.current_spell.spell_attributes, that);
        },
        checkAghanimCreation: function (value) {
            switch (value) {
                case 1: {
                    this.current_spell.created_by_aghanims_shard = 0;
                    this.current_spell.mod_by_aghanims_scepter = 0;
                    break;
                }
                case 2: {
                    this.current_spell.created_by_aghanims_scepter = 0;
                    this.current_spell.mod_by_aghanims_shard = 0;
                    break;
                }
                case 3: {
                    this.current_spell.created_by_aghanims_scepter = 0;
                    break;
                }
                case 4: {
                    this.current_spell.created_by_aghanims_shard = 0;
                    break;
                }
            }

        },
        onFileChangeHero: function (payload) {
            const file = payload.target.files[0];
            this.images.hero = file;
            this.dhero.img_is_uploaded = 1;
            this.dhero.img_path = URL.createObjectURL(file);
            URL.revokeObjectURL(file);
        },
        onFileChange: function (payload) {
            const file = payload.target.files[0];
            switch (this.current_spell.hotkey) {
                case 'Q': {
                    this.images.Q = file;
                    break;
                }
                case 'W': {
                    this.images.W = file;
                    break;
                }
                case 'E': {
                    this.images.E = file;
                    break;
                }
                case 'R': {
                    this.images.R = file;
                    break;
                }
                case 'D': {
                    this.images.D = file;
                    break;
                }
                case 'F': {
                    this.images.F = file;
                    break;
                }
            }
            this.current_spell.img_is_uploaded = 1;
            this.current_spell.img_path = URL.createObjectURL(file);
            URL.revokeObjectURL(file);
        },

        calculateDamageFromMin: function (event) {
            //calculate attack damage
            if (+this.dhero.attack_damage_min >= +this.dhero.attack_damage_max) {
                this.dhero.attack_damage_max = +this.dhero.attack_damage_min + 1;
            }
            this.calculateData();
        },
        calculateDamageFromMax: function (event) {

            if (+this.dhero.attack_damage_min >= +this.dhero.attack_damage_max) {
                this.dhero.attack_damage_min = +this.dhero.attack_damage_max - 1;
            }
            this.calculateData();
        },
        calculateData: function (event) {
            let current_level = parseInt(this.current_level) - 1;
            this.current_strength = +(parseInt(this.dhero.strength) + +this.dhero.lvlup_strength * current_level).toFixed(0);
            this.current_agility = +(parseInt(this.dhero.agility) + +this.dhero.lvlup_agility * current_level).toFixed(0);
            this.current_intelligence = +(parseInt(this.dhero.intelligence) + +this.dhero.lvlup_intelligence * current_level).toFixed(0);
            if (current_level >= 16) {
                this.current_strength += 2;
                this.current_agility += 2;
                this.current_intelligence += 2;
            }
            if (current_level >= 18) {
                this.current_strength += 2;
                this.current_agility += 2;
                this.current_intelligence += 2;
            }
            if (current_level >= 20) {
                this.current_strength += 2;
                this.current_agility += 2;
                this.current_intelligence += 2;
            }
            if (current_level >= 21) {
                this.current_strength += 2;
                this.current_agility += 2;
                this.current_intelligence += 2;
            }
            if (current_level >= 22) {
                this.current_strength += 2;
                this.current_agility += 2;
                this.current_intelligence += 2;
            }
            if (current_level >= 23) {
                this.current_strength += 2;
                this.current_agility += 2;
                this.current_intelligence += 2;
            }
            if (current_level >= 25) {
                this.current_strength += 2;
                this.current_agility += 2;
                this.current_intelligence += 2;
            }

            //calculate attack damage
            if (+this.dhero.attack_damage_min === +this.dhero.attack_damage_max) {

            }


        },
        checkDataForSubmit: function (event) {
            this.errors.hero = [];
            this.errors.spells = [];
            this.errors.talents = [];
            this.errors.description = [];

            //HERO VALIDATION
            if (!this.dhero.name) {
                this.errors.hero.push("Hero's name is required.");
            }
            if (this.dhero.name.length > 40) {
                this.errors.hero.push("Name is too long.");
            }
            if (!this.dhero.image.length) {
                this.errors.hero.push("Hero's portrait is required.");
            }
            //SPELLS VALIDATION
            if (!this.spell_Q.name.length) {
                this.errors.spells.push("Q spell's name is required.");
            }
            if (!this.spell_W.name.length) {
                this.errors.spells.push("W spell's name is required.");
            }
            if (!this.spell_E.name.length) {
                this.errors.spells.push("E spell's name is required.");
            }
            if (!this.spell_R.name.length) {
                this.errors.spells.push("R spell's name is required.");
            }
            if (!this.spell_Q.description.length) {
                this.errors.spells.push("Q spell's description is required.");
            }
            if (!this.spell_W.description.length) {
                this.errors.spells.push("W spell's description is required.");
            }
            if (!this.spell_E.description.length) {
                this.errors.spells.push("E spell's description is required.");
            }
            if (!this.spell_R.description.length) {
                this.errors.spells.push("R spell's description is required.");
            }
            //TALENTS VALIDATION

            //TEXTS VALIDATION
            if (!this.dhero.description.length) {
                this.errors.description.push('Description is required.');
            }

            if (!this.errors.hero.length && !this.errors.spells.length && !this.errors.talents.length && !this.errors.description.length) {
                this.errors.hero = [];
                this.errors.spells = [];
                this.errors.talents = [];
                this.errors.description = [];

                this.startPublish();
                //enviar
            } else {
                //bypass
                this.startPublish();
            }
        },

        startPublish: function (event) {
            this.ajax_errors = {};
            this.publish_modal = true;
        },
        presetPostNotActive: function (event) {
            this.dhero.is_active = 0;
            this.initiateAjaxPost();
        },
        presetPostActive: function (event) {
            this.dhero.is_active = 1;
            this.initiateAjaxPost();
        },
        initiateAjaxPost: function (event) {

            this.publishing = true;
            let obj = this;

            const formData = new FormData();

            formData.append('hero', JSON.stringify(this.dhero));
            formData.append('spell_Q', JSON.stringify(this.spell_Q));
            formData.append('spell_W', JSON.stringify(this.spell_W));
            formData.append('spell_E', JSON.stringify(this.spell_E));
            formData.append('spell_R', JSON.stringify(this.spell_R));
            formData.append('spell_D', JSON.stringify(this.spell_D));
            formData.append('spell_F', JSON.stringify(this.spell_F));
            formData.append('image_hero', this.images.hero);
            formData.append('image_Q', this.images.Q);
            formData.append('image_W', this.images.W);
            formData.append('image_E', this.images.E);
            formData.append('image_R', this.images.R);
            formData.append('image_D', this.images.D);
            formData.append('image_F', this.images.F);
            formData.append('post', this.dhero.id);

            // console.log(this.images);

            axios.post('/api/hero-update', formData, {'content-type': 'multipart/form-data'})
                .then((response) => {
                    this.publishing = false;
                    if (response.data.status === 'success') {
                        this.ajax_success = response.data.msg;
                        this.post_created_id = '/post/hero/' + response.data.post_id;
                    } else if (response.data.status === 'error') {
                        this.ajax_errors = response.data.errors;
                        if (response.data.msg === 'Error Throwable' || response.data.msg === 'Error Exception') {
                            this.exception = true;
                        }
                    }
                    console.log(response.data);
                })
                .catch(function (error) {
                    obj.publishing = false;
                    // this.ajax_errors = ['Conection Error. Please try again.']
                    // this.ajax_errors = error;
                    // console.log(error);
                });

        }

    },
    computed: {
        hp() {
            let current_hp = 200;
            current_hp += parseInt(this.current_strength) * 20 || 0;
            return current_hp.toFixed(0);
        },
        mana() {
            let current_mana = 75;
            current_mana += parseInt(this.current_intelligence) * 12 || 0;
            return current_mana.toFixed(0);
        },
        hp_regen() {
            let current_hp = 0;
            current_hp += parseInt(this.current_strength) * 0.1 || 0;
            current_hp += +this.dhero.basic_regen_hp;
            return current_hp.toFixed(1);
        },
        mana_regen() {
            let current_mana = 0;
            current_mana += parseInt(this.current_intelligence) * 0.05 || 0;
            current_mana += +this.dhero.basic_regen_mana;
            return current_mana.toFixed(1);
        },
        damage() {
            switch (+this.dhero.primary_attribute) {
                case 1:
                case '1': {
                    let min = (+this.dhero.attack_damage_min + +this.current_strength).toFixed(0);
                    let max = (+this.dhero.attack_damage_max + +this.current_strength).toFixed(0);
                    return min + " - " + max;
                }
                case 2:
                case '2': {

                    let min = (+this.dhero.attack_damage_min + +this.current_agility).toFixed(0);
                    let max = (+this.dhero.attack_damage_max + +this.current_agility).toFixed(0);
                    return min + " - " + max;
                }
                case 3:
                case '3': {
                    let min = (+this.dhero.attack_damage_min + +this.current_intelligence).toFixed(0);
                    let max = (+this.dhero.attack_damage_max + +this.current_intelligence).toFixed(0);
                    return min + " - " + max;
                }
                default: {
                    return 0;
                }
            }
        },
        def_armor() {
            if (+this.dhero.defense_armor + 0.167 * +this.current_agility < 0) {
                return 0;
            }
            return +(+this.dhero.defense_armor + 0.167 * +this.current_agility).toFixed(1) || 0;

        },
        armor_added() {
            return parseFloat((0.167 * +this.current_agility).toFixed(1)) || 0;

        },

        attack_per_second() {
            let ias = +this.dhero.attack_ias + +this.current_agility;
            if (ias < 20) {
                ias = 20;
            } else if (ias > 700) {
                ias = 700;
            }
            return (1 / ((+ias) / (100 * +this.dhero.attack_bat))).toFixed(2);
        },
    }
}
</script>

<style scoped>

</style>
