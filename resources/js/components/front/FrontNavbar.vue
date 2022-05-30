<template>
    <v-container fluid class="pa-0 hidden-md-and-down position-relative">
        <v-row>
            <v-col>
                <v-app-bar dense
                           color="red"
                           dark
                           flat
                           class="app_bar"
                           height="52px"
                >
                    <v-container>
                        <v-row>

                            <v-col class="navbar">
                                <div class="subnav" v-for="(menuData,key) in menusData" :key="key">
                                    <a :href="menuData.link" class="subnavbtn">{{ menuData.name }}
                                        <v-icon
                                            v-if="menuData.childrens.length!==0"
                                            class="menu_down_icon"
                                            mdi-48px
                                        >
                                            mdi-menu-down
                                        </v-icon>


                                    </a>

                                    <v-col v-if="menuData.childrens.length!=0" cols="12" class="subnav-content">
                                        <a :href="children.link"
                                           v-for="(children,key) in menuData.childrens">{{ children.name }}</a>

                                    </v-col>

                                </div>

                            </v-col>

                        </v-row>
                    </v-container>
                </v-app-bar>

            </v-col>
        </v-row>
    </v-container>

</template>

<script>
export default {
    name: "FrontNavbar",
    data() {
        return {
            menusData: [],
        }
    },
    methods: {},
    created() {
        axios.get('/menus/all').then(({data}) => {
            console.log(data);
            this.menusData = data;
        })
    }
}
</script>

<style scoped>
.menuLink {
    text-decoration: none !important;
    color: #ffffff !important;
}

.subnavbtn:hover + .subnav-content {
    color: #f44336 !important;
    display: block !important;
}

.subnav-content {
    position: absolute !important;
    width: 1200px !important;
    background-color: white;
    bottom: 66px;
    margin: 0 auto;
    right: 0;
    top: 52px;
    height: 62px;
    border-radius: 0 0 5px 5px
}

.v-app-bar {
    z-index: 1 !important;

}

/* The navigation menu */
.navbar {
    overflow: hidden;

    padding: 0;
    border-radius: 2px;
}


/* Navigation links */
.navbar a {
    float: right;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* The subnavigation menu */
.subnav {
    float: right;
    overflow: hidden;
    height: 52px !important;
}

/* Subnav button */
.subnav .subnavbtn {
    font-size: 15px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

/* Add a red background color to navigation links on hover */
.navbar a:hover, .subnav:hover .subnavbtn {
    background-color: #EEE1E1;
    color: #f44336;
}

.subnav:hover .menu_down_icon {
    color: #f44336 !important;
}

/* Style the subnav content - positioned absolute */
.subnav-content {
    display: none;
    position: absolute;
    left: 0;
    background-color: #EEE1E1;
    width: 100%;
    z-index: 1;
}

/* Style the subnav links */
.subnav-content a {
    float: right;
    color: black;
    text-decoration: none;
    padding: 10px;

}

/* Add a grey background color on hover */
.subnav-content a:hover {

    color: #f44336;

}

/* When you move the mouse over the subnav container, open the subnav content */
.subnav:hover .subnav-content {
    display: block;
    bottom: -51px !important;
}

.menu_down_icon {
    color: white !important;
}

</style>
