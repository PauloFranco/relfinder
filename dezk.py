import pandas as pd
from matplotlib import pyplot as plt
import numpy as np
import math
from sklearn.preprocessing import LabelEncoder
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis as LDA
from pprint import pprint

sum = 0

for i in range(1000, 10000):
    if(i%7 != 0 and i%11 != 0):
        sum = sum + i

print sum