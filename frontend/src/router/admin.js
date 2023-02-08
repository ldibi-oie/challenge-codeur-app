export default [
    {
        path: '/admin',
        name: 'admin',
        component: () => import('../views/Admin/PanelView.vue'),
    },
    {
        path: '/admin/form/add',
        name: 'admin_form_add',
        component: () => import('../components/Admin/Form.vue'),
    },
    {
        path: '/admin/form/edit/:id',
        name: 'admin_form_edit',
        component: () => import('../components/Admin/Form.vue'),
    },
]