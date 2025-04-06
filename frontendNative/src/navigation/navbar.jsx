import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Icon from 'react-native-vector-icons/FontAwesome5';
import { View, Text } from 'react-native';

import Login from '../screens/login';
import Registro from '../screens/registro';
import Layout from '../screens/layout';

const Stack = createNativeStackNavigator();
const Tab = createBottomTabNavigator();

const MainTabs = () => (
    <Tab.Navigator
        screenOptions={({ route }) => ({
            headerShown: false,
            tabBarShowLabel: false,
            tabBarStyle: {
                backgroundColor: '#ffffff',
                borderTopLeftRadius: 20,
                borderTopRightRadius: 20,
                height: 65,
                paddingBottom: 10,
                paddingTop: 10,
                elevation: 10,
                shadowColor: '#000',
                shadowOpacity: 0.1,
                shadowRadius: 5,
                shadowOffset: { width: 0, height: -3 },
                position: 'absolute',
            },
            tabBarIcon: ({ focused }) => {
                let iconName;
                let label;

                switch (route.name) {
                    case 'Layout':
                        iconName = 'home';
                        label = 'Inicio';
                        break;
                    case 'Login':
                        iconName = 'sign-in-alt';
                        label = 'Login';
                        break;
                    case 'Registro':
                        iconName = 'user-plus';
                        label = 'Registrarse';
                        break;
                }

                return (
                    <View style={{ alignItems: 'center', justifyContent: 'center' }}>
                        <Icon name={iconName} size={20} color={focused ? '#007bff' : '#888'} />
                        <Text style={{ fontSize: 12, color: focused ? '#007bff' : '#888', marginTop: 4 }}>
                            {label}
                        </Text>
                    </View>
                );
            },
        })}
    >
        <Tab.Screen name="Layout" component={Layout} />
        <Tab.Screen name="Login" component={Login} />
        <Tab.Screen name="Registro" component={Registro} />
    </Tab.Navigator>
);

const Navbar = () => {
    return (
        <Stack.Navigator screenOptions={{ headerShown: false }}>
            <Stack.Screen name="Main" component={MainTabs} />
            {/* Estas rutas pueden estar aquí si quieres navegar a ellas fuera del Tab */}
            {/* También pueden omitirse si solo están dentro de los Tabs */}
        </Stack.Navigator>
    );
};

export default Navbar;
