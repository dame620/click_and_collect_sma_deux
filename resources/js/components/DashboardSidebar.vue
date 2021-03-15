<template>
    <div class="sidebar" :class="{minimize: is_minimized}">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span> <span>Click And Collect</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="/dashboard" class="active">
                        <span class="las la-igloo"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="las la-users"></span>
                        <span>Clients</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/allshipment">
                        <span class="las la-clipboard-list"></span>
                        <span>Expeditions</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="las la-shopping-bag"></span>
                        <span>En Attente</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="las la-receipt"></span>
                        <span>Roles</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="las la-user-circle"></span>
                        <span>Utilisateur Sma</span>
                    </a>
                </li>

                <!--li>
                    <a href="">
                        <span class="las la-clipboard-list"></span>
                        <span>Tasks</span>
                    </a>
                </li-->
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        is_minimized: { type: Boolean, default: false }
    },
};
</script>
