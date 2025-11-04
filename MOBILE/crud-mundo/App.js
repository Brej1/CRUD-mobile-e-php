import {NavigationContainer} from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Home from './screens/home.js';
import Create from './screens/create.js';
import Read from './screens/read.js';
import Update from './screens/update.js';

const Stack = createNativeStackNavigator();


function AppContent() {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Home">
        <Stack.Screen name="Home" component={Home} />
        <Stack.Screen name="Create" component={Create} />
        <Stack.Screen name="Read" component={Read} />
        <Stack.Screen name="Update" component={Update} />
       </Stack.Navigator>
    </NavigationContainer>
    
  );
}

export default AppContent;