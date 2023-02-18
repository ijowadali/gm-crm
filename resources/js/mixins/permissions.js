import store from '@/store';

export const permissions = {
  methods: {
    permission(value, verifyAdmin = true) {
      const permissions = store.getters && store.getters.permissions;
      const roles = store.getters && store.getters.roles;
      if (verifyAdmin) {
        if (roles.includes('admin') || roles.includes('super admin')) {
          return true;
        }
      }
      if (value && value instanceof Array && value.length > 0) {
        const requiredPermissions = value;
        const hasPermission = permissions.some(permission => {
          return requiredPermissions.includes(permission);
        });
        if (!hasPermission) {
          return false;
        }
      }
      return true;
    },

    invertPermission(value, verifyAdmin = true) {
      const permissions = store.getters && store.getters.permissions;
      const roles = store.getters && store.getters.roles;
      if (verifyAdmin) {
        if (roles.includes('admin') || roles.includes('super admin')) {
          return true;
        }
      }
      if (value && value instanceof Array && value.length > 0) {
        const requiredPermissions = value;
        const hasPermission = permissions.some(permission => {
          return requiredPermissions.includes(permission);
        });
        if (!hasPermission) {
          return true;
        }
      }
      return false;
    },
  },
};
