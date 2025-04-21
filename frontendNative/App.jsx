import React from "react";
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Navbar from './src/navigation/navbar';  // Asegúrate de que el nombre de la importación sea correcto
import { AuthProvider } from "./src/context/authContext";

const Stack = createNativeStackNavigator();

export default function App() {
    return (
        <AuthProvider>  {/* Aquí envolvemos toda la aplicación con el contexto de autenticación */}
            <NavigationContainer>
                <Stack.Navigator screenOptions={{ headerShown: false }}>
                    <Stack.Screen name="Navegador" component={Navbar} />
                </Stack.Navigator>
            </NavigationContainer>
        </AuthProvider>
    );
}
