<script>
export default {
    name: "hero-general",
    data: function () {
        return {
            loading: true,
            current_level: 1,
            current_strength: 0,
            current_agility: 0,
            current_intelligence: 0,
            tab_selected: 1,
            initial_damage: 0,
            initial_armor: 0,
            hero: [],
            attack_damage_projection: {
                'value': 55,
                'growth_per_level': 2.2,
                'add_range': 10,
                'increases_over_level': true
            },
            attack_speed_projection: {
                'value': 1.7,
                'growth_per_level': 0.1,
                'add_range': 1,
                'increases_over_level': false
            },
            armor_projection: {
                'value': 1,
                'growth_per_level': 0.25,
                'add_range': 2,
                'increases_over_level': true
            },
        }

    },
    mounted() {
        this.loadHero();

    },
    methods: {
        async loadHero() {
            await this.fetchHero();
        },
        fetchHero() {
            let id = window.location.href.split('/').pop();
            axios.get('/api/hero/' + id)
                .then((response) => {
                    this.hero = response.data.data[0];
                    this.calculateData();
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        changeTab: function (index) {
            this.tab_selected = index;
        },
        calculateData: function (event) {
            let current_level = parseInt(this.current_level) - 1;
            this.current_strength = +(this.hero.strength + this.hero.lvlup_strength * current_level).toFixed(0);
            this.current_agility = +(this.hero.agility + this.hero.lvlup_agility * current_level).toFixed(0);
            this.current_intelligence = +(this.hero.intelligence + this.hero.lvlup_intelligence * current_level).toFixed(0);
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
        }
    },
    computed: {
        hp() {
            let current_hp = this.hero.basic_value_hp || 0;
            current_hp += parseInt(this.current_strength) * 20 || 0;
            return current_hp.toFixed(0);
        },
        mana() {
            let current_mana = this.hero.basic_value_mana || 0;
            current_mana += parseInt(this.current_intelligence) * 12 || 0;
            return current_mana.toFixed(0);
        },
        hp_regen() {
            let current_hp = 0;
            current_hp += parseInt(this.current_strength) * 0.1 || 0;
            current_hp += +this.hero.basic_regen_hp;
            return current_hp.toFixed(1);
        },
        mana_regen() {
            let current_mana = 0;
            current_mana += parseInt(this.current_intelligence) * 0.05 || 0;
            current_mana += +this.hero.basic_regen_mana;
            return current_mana.toFixed(1);
        },
        min_damage() {
            switch (this.hero.primary_attribute) {
                case 1: {
                    return (this.hero.attack_damage_min + this.current_strength).toFixed(0);
                }
                case 2: {
                    return (this.hero.attack_damage_min + this.current_agility).toFixed(0);
                }
                case 3: {
                    return (this.hero.attack_damage_min + this.current_intelligence).toFixed(0);
                }
                default: {
                    return 0;
                }
            }

        },
        max_damage() {
            switch (this.hero.primary_attribute) {
                case 1: {
                    return (this.hero.attack_damage_max + this.current_strength).toFixed(0);
                }
                case 2: {
                    return (this.hero.attack_damage_max + this.current_agility).toFixed(0);
                }
                case 3: {
                    return (this.hero.attack_damage_max + this.current_intelligence).toFixed(0);
                }
                default: {
                    return 0;
                }
            }
        },
        armor() {
            return parseFloat((this.hero.defense_armor + 0.167 * this.current_agility).toFixed(1)) || 0;

        },
        armor_added() {
            return parseFloat((0.167 * this.current_agility).toFixed(1)) || 0;

        },
        attack_per_second() {
            let ias = +this.hero.attack_ias + +this.current_agility;
            if (ias < 20) {
                ias = 20;
            } else if (ias > 700) {
                ias = 700;
            }
            return (1 / ((+ias) / (100 * +this.hero.attack_bat))).toFixed(2);
        },


    }
}
</script>

<style scoped>

</style>
