// frontendNative/src/navigation/navbar.js
import React from 'react';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Login from '../screens/login';
import registro from '../screens/registro';

const Stack = createNativeStackNavigator();

const Navbar = () => {
    return (
        <Stack.Navigator screenOptions={{ headerShown: false }}>
            <Stack.Screen name="Login" component={Login} />
            <Stack.Screen name="registro" component={registro} />
        </Stack.Navigator>
    );
};

export default Navbar;
