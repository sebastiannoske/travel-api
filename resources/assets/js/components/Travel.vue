<template>

    <div id="vue-wrap">

        <div id="filter-input-wrap">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                <label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
                    <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" id="sample6" v-model="search">
                    <label class="mdl-textfield__label" for="sample-expandable">Volltextsuche</label>
                </div>
            </div>
        </div>

        <table class="table table-striped">

            <thead>

                <tr>

                    <th>erstellt</th>
                    <th>Art</th>
                    <th>PLZ</th>
                    <th>Abfahrtsort</th>
                    <th>Verkehrsmittel</th>
                    <th>Aktionsort</th>
                    <th>per Mail bestätigt?</th>
                    <th></th>
                    <th></th>
                    <th>Aktiv?</th>

                </tr>

            </thead>

            <tbody>

                <tr v-for='(key, val) in filteredTravel' v-bind:class="{ request: key.request }">

                    <td>{{key.dateHuman}}</td>
                    <td v-if='key.offer'>Angebot</td>
                    <td v-if='key.request'>Gesuch</td>
                    <td>{{key.postcode}}</td>
                    <td>{{key.city}}</td>
                    <td>{{key.transportation_mean.name}}</td>
                    <td>{{key.destination.name}}</td>
                    <td v-if='key.isVerified'><img src="/img/checked.svg"/></td>
                    <td v-if='!key.isVerified' class="public-switch">
                        <img src="/img/not-checked.svg"/>
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" v-bind:for="key.label">
                            <input type="checkbox" v-bind:id="key.label" class="mdl-switch__input" v-bind:data-ref-id="key.id" v-model='key.isPublic' v-bind:true-value="true" v-bind:false-value="false">
                            <span class="mdl-switch__label"></span>
                        </label>
                    </td>
                    <td><a v-bind:href="key.editURL" target="_self"><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">editieren</button></a></td>
                    <td><button class="btn-delete-travel mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent" v-bind:data-ref-id="key.id">löschen</button></td>
                    <td class="public-switch">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" v-bind:for="key.label">
                            <input type="checkbox" v-bind:id="key.label" class="mdl-switch__input" v-bind:data-ref-id="key.id" v-model='key.isPublic' v-bind:true-value="true" v-bind:false-value="false">
                            <span class="mdl-switch__label"></span>
                        </label>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</template>

<script>
    export default {
        props: ['travel'],
        data: function() {
            return {
                search: ''
            };
        },
        computed: {
            listJson: function(){
                return JSON.parse(this.travel).data;
            },
            filteredTravel:function() {
                var that = this;

                return this.listJson.filter(
                    function(travel){
                        return travel.userData.toLowerCase().indexOf(that.search.toLowerCase())>=0
                             || travel.city.toLowerCase().indexOf(that.search.toLowerCase())>=0
                             || travel.postcode.toLowerCase().indexOf(that.search.toLowerCase())>=0
                             || travel.destination.name.toLowerCase().indexOf(that.search.toLowerCase())>=0
                             || travel.transportation_mean.name.toLowerCase().indexOf(that.search.toLowerCase())>=0
                    }
                );
            }
        },
        updated() {
            componentHandler.upgradeDom();
        }
    }
</script>
